import { StyleSheet, Text, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { NativeStackScreenProps } from '@react-navigation/native-stack';
import { useJwt } from 'react-jwt';
import { UserNameContext } from '../context/UserContext';
import LogoutScreen from '../screens/LogoutScreen';
import UserProfile from '../components/UserProfile';
import Prueba from '../screens/Prueba';
import PruebaAdmin from '../screens/PruebaAdmin';
import MatriculaTabNav from './MatriculaTabNav';
import { createDrawerNavigator } from '@react-navigation/drawer';


type Props = {}

type TokenPayload = {
  role: string;
};

type AuthScreens = {
  LoginScreen: undefined,
  RegisterScreen: undefined,
  DrawerNav: undefined,
}

type LoginProps = NativeStackScreenProps<AuthScreens, "DrawerNav">


const Drawer = createDrawerNavigator();
const DrawerNavigation = (props: Props) => {
  const context = useContext(UserNameContext);
  
  const authorizedRol = "ROLE_ADMIN";

  const [isAdmin, setiIsAdmin] = useState<boolean>(false);
  const { decodedToken } = useJwt<TokenPayload>(context.token);
  

  useEffect(() => {
    const checkRole = async () => {
      if(context.rol == authorizedRol){
        setiIsAdmin(true);
      } else {
        setiIsAdmin(false);
      }
    } 



    checkRole();

  }, [decodedToken, context.rol])
  


  return (
    <Drawer.Navigator id={undefined}>
      <Drawer.Screen name="Perfil" component={UserProfile} options={{ title: 'Mi perfil' }} />
      {
        isAdmin ? 
          <Drawer.Screen name="Operaciones" component={PruebaAdmin} options={{ title: 'Alumnos (ADMIN)' }}/>

        :
        <Drawer.Screen name="Operaciones" component={Prueba} options={{ title: 'Alumnos' }}/>
      }

      {
        isAdmin &&
        <Drawer.Screen name="OperacionesMatriculas" component={MatriculaTabNav} options={{ title: 'Matriculas (ADMIN)' }}/> 
      }
      <Drawer.Screen name="Logout" component={LogoutScreen} options={{ title: 'Cerrar sesión' }}/>
    </Drawer.Navigator>
  )
}

export default DrawerNavigation

const styles = StyleSheet.create({})