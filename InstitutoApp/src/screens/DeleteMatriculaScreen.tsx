import { Alert, StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useEffect, useState } from 'react'
import { FlatList } from 'react-native-gesture-handler';
import Icon from 'react-native-vector-icons/Ionicons';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { Matricula } from '../entities/Matricula';

type Props = {}

type MatriculaData = {
  alumno : AlumnoData,
  year : string,
  asignaturas : AsignaturaData[]
}

type AsignaturaData = {
  nombre : string,
  curso : string,
}

type AlumnoData = {
  dni: string,
  nombre : string,
  apellidos : string,
}

const DeleteMatriculaScreen = (props: Props) => {
  const [data, setData] = useState<Matricula[]>([]);

  useEffect(() => {
      const fetchData = async () => {
          const token = await AsyncStorage.getItem("token");
          if (!token) {
              console.error("Token no disponible");
              return;
          }

          try {
              const response = await axios.get(`http://10.108.8.0:8080/v1/matriculas`, {
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


  function showConfirmation (id : number){
    Alert.alert(`Eliminar`,`¿Está seguro de que desea borrar la matricula cuyo id es ${id}?`,
      [
        {
          text: 'No',
          onPress: () => console.log('No se ha eliminado la asignatura'),
          style: 'cancel'
        },
        {
          text: 'Sí',
          onPress: () => handleDelete(id),
          style:'destructive'
        }

      ]
    )
  }

  const handleDelete = async (id : number) => {
    try {
      const token = await AsyncStorage.getItem("token");
      console.log(`http://10.108.8.0:8080/v1/matriculas?id=${id}`);
      const response = await axios.delete(`http://10.108.8.0:8080/v1/matriculas/{id}?id=${id}`, {
        headers: {
            Authorization: 'Bearer ' + token,
        },
    });
    
        console.log("Respuesta del servidor:", response.data); 
    } catch (error) {
        console.error("Error al obtener los datos:", error);
    }
  }

  return (
      <View >
        {data &&
          <FlatList
              data={data}
              renderItem={({ item }) => (
                  <View >
                      <Text >{item.alumno.nombre} {item.alumno.apellidos} -- {item.year}
                      </Text>
                      <View >
                          <TouchableOpacity onPress={() => showConfirmation(item.id)} >
                              <Icon name='close' size={35} color={'#d1234e'} />
                          </TouchableOpacity>
                      </View>
                  </View>
              )}
              keyExtractor={(item, index) => item.alumno.dni + "_" + item.year + "_" + index}
          />
        }
    </View>
  )
}

export default DeleteMatriculaScreen

