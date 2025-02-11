import { StyleSheet, Text, View, Image, ScrollView } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { NativeStackScreenProps } from '@react-navigation/native-stack';
import axios, { spread } from 'axios';
import { FlatList} from 'react-native-gesture-handler';
import Icon  from 'react-native-vector-icons/Ionicons';

import { ActivityIndicator } from 'react-native';
import { UserNameContext } from '../context/UserContext';

type Props = {}

type UserData = {
    correo : string,
    nombre : string
}
const UserProfile = (props: Props) => {

    const [data, setData] = useState<UserData>({} as UserData);
    const context = useContext(UserNameContext);
    

    useEffect(() => {
        if(!context.nombreUsuario || !context.token){
          console.log('el nombre no esta seteado');
          return;
        }

        const fetchData = async () => {
          console.log("Nombre de usuario:", context.nombreUsuario);
          if (!context.nombreUsuario) {
              console.error("El nombre de usuario no está disponible");
              return;
          }

          const nombre =  context.nombreUsuario;
          const token = context.token;

          console.log("Token:", token);
          if (!token) {
              console.error("Token no disponible");
              return;
          }

          try {
              const response = await axios.get(`10.108.8.0:8080/v1/usuarios/nombre/${nombre}`, {
                  headers: {
                      Authorization: 'Bearer ' + token,
                  },
              });
              console.log("Respuesta del servidor:", response.data); 
              let userData = response.data.data;
              setData(userData); 
              console.log(data);
          } catch (error) { 
              console.error("Error al obtener los datos:", error);
          }
      };

      fetchData();
    }, [])


    
    
  return (

  <View >
    <Text >Datos: </Text>
    <Text>Correo: {data.correo} </Text>
    <Text>Nombre: {context.nombreUsuario} </Text>
    <Text>Role: {context.rol}</Text>
  </View>


  )
}

export default UserProfile


  
  