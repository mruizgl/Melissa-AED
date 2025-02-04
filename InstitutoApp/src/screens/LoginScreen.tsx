import React, { useState } from 'react'
import axios from 'axios';
import { Button, TextInput, View } from 'react-native';



const LoginScreen = () => {

    const [nombre, setnombre] = useState<string>('');
    const [password, setpassword] = useState<string>('');
    const [token, settoken] = useState<string>('');

    const handleLogin = async () => {
        const response = await axios.post('http://10.108.8.0:8080/auth/login', {
            nombre: nombre,
            password: password,
        
        });

        if (response.status === 200) {
            settoken(response.data);
            console.log("login exitoso")
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