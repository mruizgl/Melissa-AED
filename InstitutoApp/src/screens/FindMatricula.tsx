import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { FlatList, RefreshControl, TextInput } from 'react-native-gesture-handler';
import Icon from 'react-native-vector-icons/Ionicons';

import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { NativeStackScreenProps } from '@react-navigation/native-stack';
import { MatriculaContextHook } from '../context/MatriculaContext';
import { Matricula } from '../entities/Matricula';

type Props = {}

type MatriculaDetailsType = {
  FindMatricula: undefined,
  MatriculaDetails: undefined,
}

type PropsMatricula = NativeStackScreenProps<MatriculaDetailsType, 'FindMatricula'>;

const FindMatricula = (props: PropsMatricula) => {
  const [data, setData] = useState<Matricula>();
  const [refresh, setRefresh] = useState(false);
  const [refreshing, setRefreshing] = useState(false);
  
  const [busqueda, setBusqueda] = useState<string>("");

  const context = useContext(MatriculaContextHook);

  useEffect(() => {
    console.log("Datos actualizados:", data);
  }, [data])
 

  function refreshData() {
    setRefresh(!refresh);
    setRefreshing(true);
    setTimeout(() => {
      setRefreshing(false);
    }, 1000);
  }

  const fetchData = async (id : string) => {
    const token = await AsyncStorage.getItem("token");
    if (!token) {
        console.error("Token no disponible");
        return;
    }

    try {
        const response = await axios.get(`http://10.108.8.0:8080/instituto/api/matriculas/{id}?id=${id}`, {
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

  function handleScreen(id : number){
    if(id){
      context.setId(id);
      console.log("navegando")
      props?.navigation?.navigate('MatriculaDetails');
    } 
  }



  return (
    <View >
      <TextInput
        placeholder="Id de la matricula"
        onChangeText={(text) => setBusqueda(text)}
      />
    
      <TouchableOpacity  onPress={() => fetchData(busqueda)}>
        <Text> Buscar </Text>
      </TouchableOpacity>

      { data &&
          <TouchableOpacity onPress={() => handleScreen(data?.id)} >
              <Text >{data?.alumno?.nombre} {data?.alumno?.apellidos} -- {data?.year}</Text>
          </TouchableOpacity>
      }
    
    </View>
  )
}

export default FindMatricula
