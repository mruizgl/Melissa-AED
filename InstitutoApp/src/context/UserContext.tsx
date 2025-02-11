import { StyleSheet, Text, View } from 'react-native'
import React, { createContext, useEffect, useState } from 'react'
import AsyncStorage from '@react-native-async-storage/async-storage';

type Props = {
  children: React.ReactNode;
}
type UsuarioContextType ={
  nombreUsuario: string,
  setNombreUsuario: (nombreUsuario: string) => void,
  token: string,
  setToken: (token: string) => void,
  rol: string,
  setRol: (rol: string) => void,

}

export const UserNameContext = createContext<UsuarioContextType>({} as UsuarioContextType );
const UserContext = (props: Props) => {
  const [nombreUsuario, setNombreUsuario] = useState<string>("");
  const [token, setToken] = useState<string>("");
  const [rol, setRol] = useState<string>("");

  useEffect(() => {
    async () => {
      const tokenStorage = await AsyncStorage.getItem("token");
  
      if(tokenStorage){
        setToken(tokenStorage);
      }
    }

  }, [token])

  useEffect(() => {
    
    async () => {
      const userStorage = await AsyncStorage.getItem("nombreusuario");
  
      if(userStorage){
        setNombreUsuario(userStorage);
      }
    }

  }, [nombreUsuario])
  
  useEffect(() => {
    
    async () => {
      const roleStorage = await AsyncStorage.getItem("rol");
  
      if(roleStorage){
        setRol(roleStorage);
      }
    }

  }, [rol])

  const contextValues: UsuarioContextType  = {
    nombreUsuario,
    setNombreUsuario,
    token,
    setToken,
    rol,
    setRol
  }

  return (
    <UserNameContext.Provider value={contextValues}>
      {props.children}
    </UserNameContext.Provider>

  )
}

export default UserContext

const styles = StyleSheet.create({})