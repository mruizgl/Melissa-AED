import React, { useEffect, useState } from 'react';
import { View, Text, FlatList, ActivityIndicator, StyleSheet } from 'react-native';

interface Asignatura {
  id: number;
  curso: string;
  nombre: string;
}

interface Matricula {
  id: number;
  year: number;
  asignaturas: Asignatura[];
}

const ListaMatriculasScreen = () => {
  const [matriculas, setMatriculas] = useState<Matricula[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchMatriculas = async () => {
      try {
        const response = await fetch('http://10.108.8.0:8080/instituto/api/v1/matriculas');
        if (!response.ok) {
          throw new Error('Error al obtener las matrículas');
        }
        const data: Matricula[] = await response.json();
        setMatriculas(data);
      } catch (error) {
        if (error instanceof Error) {
            setError(error.message);
          } else {
            setError('Ocurrió un error desconocido');
          }          
      } finally {
        setLoading(false);
      }
    };

    fetchMatriculas();
  }, []);

  if (loading) return <ActivityIndicator size="large" color="#0000ff" />;
  if (error) return <Text style={styles.error}>{error}</Text>;

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Lista de Matrículas</Text>
      <FlatList
        data={matriculas}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View style={styles.item}>
            <Text style={styles.year}>📅 Año: {item.year}</Text>
            <Text style={styles.subtitle}>📚 Asignaturas:</Text>
            {item.asignaturas.map((asig) => (
              <Text key={asig.id} style={styles.subject}>
                - {asig.curso}: {asig.nombre}
              </Text>
            ))}
          </View>
        )}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, padding: 16, backgroundColor: '#fff' },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 10 },
  item: { padding: 10, borderBottomWidth: 1, borderBottomColor: '#ccc' },
  year: { fontSize: 18, fontWeight: 'bold' },
  subtitle: { fontSize: 16, marginTop: 5, fontWeight: 'bold' },
  subject: { fontSize: 14, marginLeft: 10 },
  error: { color: 'red', fontSize: 16, textAlign: 'center', marginTop: 20 },
});

export default ListaMatriculasScreen;
