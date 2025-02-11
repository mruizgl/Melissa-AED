import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { TextInput } from 'react-native-gesture-handler';
import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { UserNameContext } from '../context/UserContext';


type Props = {}

const AddMatricula = (props: Props) => {
  
  const [year, setYear] = useState<string>("");
  const [asignaturasId, setAsignaturasId] = useState<string>("");
  const [dni, setDNI] = useState<string>("");

  const context = useContext(UserNameContext);
  useEffect(() => {

  }, [])
  

  const create = async () => {
      if(!asignaturasId || !asignaturasId){
          return;
      }

      try {
        const token = context.token;

        const arr: number[] = asignaturasId.split(",").map(Number);
        console.log(arr); 


        const response = await axios.post(`http://10.108.8.0:8080/v1/matriculas`, {
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
    
      } catch (error) {
        console.error("Error al actualziar la asignatura: ", error || error);
        if (error) {
            console.log("Detalles del error: ", error);
        }
    }
    
  };


    
return (
  <View >
      <Text >Crear nueva matrícula</Text>
      
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

      <TouchableOpacity  onPress={() => create()}>
        <Text >Crear</Text>
      </TouchableOpacity>


    </View>
  )
}

export default AddMatricula

const styles = StyleSheet.create({
  
});
