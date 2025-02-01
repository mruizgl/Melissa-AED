import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { Usuario } from '../data/types';

const ProfileScreen: React.FC = () => {
  const [usuario, setUsuario] = useState<Usuario | null>(null);

  useEffect(() => {
    const fetchUsuario = async () => {
      const token = await AsyncStorage.getItem('userToken');
      const response = await axios.get('YOUR_API_URL/profile', {
        headers: { Authorization: `Bearer ${token}` },
      });
      setUsuario(response.data);
    };
    fetchUsuario();
  }, []);

  return (
    <View style={styles.container}>
      {usuario && (
        <>
          <Text>DNI: {usuario.dni}</Text>
          <Text>Nombre: {usuario.nombre}</Text>
          <Text>Correo: {usuario.correo}</Text>
        </>
      )}
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', padding: 16 },
});

export default ProfileScreen;