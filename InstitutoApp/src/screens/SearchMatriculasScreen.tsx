import React, { useState } from 'react';
import { View, Text, TextInput, Button, FlatList, StyleSheet } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import { Matricula } from '../data/types';

const SearchMatriculasScreen: React.FC = () => {
  const [query, setQuery] = useState<string>('');
  const [results, setResults] = useState<Matricula[]>([]);

  const handleSearch = async () => {
    const token = await AsyncStorage.getItem('userToken');
    const response = await axios.get(`YOUR_API_URL/matriculas/search?query=${query}`, {
      headers: { Authorization: `Bearer ${token}` },
    });
    setResults(response.data);
  };

  return (
    <View style={styles.container}>
      <TextInput
        style={styles.input}
        placeholder="Search Matriculas"
        value={query}
        onChangeText={setQuery}
      />
      <Button title="Search" onPress={handleSearch} />
      <FlatList
        data={results}
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
  input: { height: 40, borderColor: 'gray', borderWidth: 1, marginBottom: 12, padding: 10 },
});

export default SearchMatriculasScreen;