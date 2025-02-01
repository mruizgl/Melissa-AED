import React, { useEffect, useState } from 'react';
import { View, Text, FlatList, StyleSheet } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { Matricula } from '../data/types';

const MatriculasScreen: React.FC = () => {
  const [matriculas, setMatriculas] = useState<Matricula[]>([]);

  useEffect(() => {
    const fetchMatriculas = async () => {
      const token = await AsyncStorage.getItem('userToken');
      const response = await axios.get('YOUR_API_URL/matriculas', {
        headers: { Authorization: `Bearer ${token}` },
      });
      setMatriculas(response.data);
    };
    fetchMatriculas();
  }, []);

  return (
    <View style={styles.container}>
      <FlatList
        data={matriculas}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View>
            <Text>Year: {item.year}</Text>
            <Text>Asignaturas:</Text>
            {item.asignaturas.map(asignatura => (
              <Text key={asignatura.id}>{asignatura.nombre}</Text>
            ))}
          </View>
        )}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', padding: 16 },
});

export default MatriculasScreen;