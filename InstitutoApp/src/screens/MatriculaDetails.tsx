import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { TextInput } from 'react-native-gesture-handler'
import axios from 'axios'
import AsyncStorage from '@react-native-async-storage/async-storage'


import { NativeStackScreenProps } from '@react-navigation/native-stack'
import { MatriculaContextHook } from '../context/MatriculaContext'

type Props = {}

type MatriculaDetailsType = {
  FindMatricula: undefined,
  MatriculaDetails: undefined,
}

type PropsMatricula = NativeStackScreenProps<MatriculaDetailsType, 'MatriculaDetails'>;

const MatriculaDetails = (props: PropsMatricula) => {
  
  const [year, setYear] = useState<string>("");
  const [asignaturasId, setAsignaturasId] = useState<string>("");
  const [dni, setDNI] = useState<string>("");

  const context = useContext(MatriculaContextHook);
  useEffect(() => {

  }, [])
  

  const update = async () => {
      if(!asignaturasId || !asignaturasId){
          return;
      }

      try {
        const token = await AsyncStorage.getItem("token");
        console.log(asignaturasId);
        console.log("URL del API: ", `http://10.108.8.0:8080/instituto/api/asignaturas`);

        const arr: number[] = asignaturasId.split(",").map(Number);
        console.log(arr); 


        const response = await axios.put(`http://10.108.8.0:8080/instituto/api/matriculas/{id}?id=${context.id}`, {
              year: year,
              asignaturasId: arr,
              alumno: dni
          },
          {
            headers:{
              Authorization: 'Bearer ' + token,
            }   
          }
      );

        console.log("Respuesta del servidor: ", response.data);
        props.navigation.goBack();
    
      } catch (error) {
        console.error("Error al actualziar la asignatura: ", error);
        if (error) {
            console.log("Detalles del error: ", error);
        }
    }
    
  };


    
return (
  <View >
      <Text >Matrícula {context.id}</Text>
      
      <TextInput
        placeholder="Año de la matricula"
        value={year}
        onChangeText={(text)=>setYear(text)}
      />
            
      <TextInput
        placeholder="Asignaturas"
        value={asignaturasId}
        onChangeText={(text)=>setAsignaturasId(text)}
      />

      <TextInput
        placeholder="DNI del alumno"
        value={dni}
        onChangeText={(text)=>setDNI(text)}
      />

      <TouchableOpacity  onPress={() => update()}>
        <Text >Crear</Text>
      </TouchableOpacity>


    </View>
  )
}

export default MatriculaDetails
