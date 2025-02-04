import React, { useContext, useState } from 'react'
import axios from 'axios';
import { Button, TextInput, View } from 'react-native';
import { AppContext, AppProvider } from '../context/AppContext';



const LoginScreen = () => {

    const [nombre, setnombre] = useState<string>('');
    const [password, setpassword] = useState<string>('');
    const [token, settoken] = useState<string>('');
    const { isAuthenticated, setIsAuthenticated } = useContext(AppContext)!;

    const handleLogin = async () => {
        const response = await axios.post('http://192.168.0.28:8082/auth/login', {
            nombre: nombre,
            password: password,
        
        });

        if (response.status === 200) {
            settoken(response.data);
            console.log("login exitoso")
            setIsAuthenticated(true);
        }else {
            console.log("error")
        }
    }
  return (
    <View>
        <TextInput placeholder="Nombre" value={nombre} onChangeText={setnombre}/>
        <TextInput placeholder='Contraseña'secureTextEntry value={password} onChangeText={setpassword} />
        <Button title="Login" onPress={handleLogin} />
        
    </View>
  )
};

export default LoginScreen;