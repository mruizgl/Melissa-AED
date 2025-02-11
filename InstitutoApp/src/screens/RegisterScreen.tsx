import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import axios from 'axios';
import { TextInput } from 'react-native-gesture-handler';
import { NativeStackScreenProps } from '@react-navigation/native-stack';
import AsyncStorage  from '@react-native-async-storage/async-storage';

type Props = {}

type AuthScreens = {
    LoginScreen: undefined,
    RegisterScreen: undefined,
    DrawerNav: undefined,
    LogoutScreen: undefined
}
  
type RegisterProps = NativeStackScreenProps<AuthScreens, "RegisterScreen">

const RegisterScreen = (props: RegisterProps) => {
  const [registered, setRegistered] = useState<boolean>(false)
  const [nombre, setNombre] = useState<string>("")
  const [correo, setCorreo] = useState<string>("")
  const [password, setPassword] = useState<string>("")

  
  useEffect(() => {
    setRegistered(false);
  }, [])
  

  useEffect(() => {
    if (registered) {
      props.navigation.navigate('LoginScreen');
    }
  }, [registered]);

  const handleRegister = async (nombre : string, correo: string, password : string) => {
      if(!nombre || nombre.trim() === "" || !password || password.trim() === ""){
          return;
      }

      try {
        const response = await axios.post(`http://10.108.8.0:8080/register`, {
              nombre,
              correo,
              password 
          },
          {
            headers:{
              'Content-Type': 'application/json'
            }   
          }
      );

      console.log("Respuesta del servidor: ", response.data);
    
      
        if (response.data) {
            setRegistered(true);
        }
      } catch (error) {
        console.error("Error al iniciar sesión", error);
      }
  };


    
return (
<View >
    <Text >Registrarse</Text>
    
    <TextInput
      placeholder="Nombre de usuario"
      value={nombre}
      onChangeText={setNombre}
    />
    
    <TextInput
      placeholder="Correo electrónico"
      value={correo}
      onChangeText={setCorreo}
    />

    <TextInput
      placeholder="Contraseña"
      secureTextEntry
      value={password}
      onChangeText={setPassword}
    />
    
    <TouchableOpacity onPress={() => handleRegister(nombre, correo, password)}>
      <Text >Registrarse</Text>
    </TouchableOpacity>

    <TouchableOpacity  onPress={() => props.navigation.navigate('LoginScreen')}>
      <Text>¿Ya tienes una cuenta? Inicia sesión</Text>
    </TouchableOpacity>

  </View>
)
}


export default RegisterScreen
