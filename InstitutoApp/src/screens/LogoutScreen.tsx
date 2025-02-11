import { StyleSheet, Text, TouchableOpacity, View } from 'react-native'
import React, { useContext, useEffect, useState } from 'react'
import { TextInput } from 'react-native-gesture-handler'
import AsyncStorage from '@react-native-async-storage/async-storage'
import { NativeStackScreenProps } from '@react-navigation/native-stack'
import { UserNameContext } from '../context/UserContext'

type Props = {}

type AuthScreens = {
    LoginScreen: undefined,
    RegisterScreen: undefined,
    DrawerNav: undefined,
}
  
type LoginProps = NativeStackScreenProps<AuthScreens, "DrawerNav">

const LogoutScreen = (props: LoginProps) => {
    const [logged, setLogged] = useState<boolean>(true)

    const context = useContext(UserNameContext);
        
    useEffect(() => {
        if(!logged){
            props.navigation.reset({
                routes: [{ name: 'LoginScreen' }],
            });
        }
    }, [logged])

    const handleLogout = async () => {
            try {
                await AsyncStorage.removeItem("token");
                await AsyncStorage.removeItem("nombreusuario");
                await AsyncStorage.removeItem("rol");
                context.setNombreUsuario("");
                context.setToken("");
                context.setRol("");
                setLogged(false);
                console.log(context.token, context.nombreUsuario, context.rol);
            } catch(error){
                console.error("Error al elininar los elementos del async storage: "+  error);
            } 
    };


    return (
    <View >
        <Text >¿Cerrar sesión?</Text>
        <TouchableOpacity  onPress={() => handleLogout()}>
            <Text >Logout</Text>
        </TouchableOpacity>
    </View>
    )
}

export default LogoutScreen