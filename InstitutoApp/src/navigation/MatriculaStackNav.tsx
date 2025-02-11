import { StyleSheet, Text, View } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import MatriculaDetails from '../screens/MatriculaDetails';
import FindMatricula from '../screens/FindMatricula';


type Props = {}
type MatriculaNav = {
  FindMatricula: undefined,
  MatriculaDetails: undefined,
}

const Stack = createNativeStackNavigator<MatriculaNav>();

const MatriculaStackNav = (props: Props) => {
  return (
    <Stack.Navigator id={undefined}
    screenOptions={{contentStyle:{backgroundColor:'white'}}}
    >
        <Stack.Screen 
            name="FindMatricula" 
            component={FindMatricula} 
            options={({ route }) => ({
                headerShown: false,
            })} 
        />
        
        <Stack.Screen 
            name="MatriculaDetails" 
            component={MatriculaDetails} 
            options={({ route }) => ({
                title: `Matricula`,
                headerTitleAlign: 'center',
                headerStyle: {
                    backgroundColor: '#008080', 
                },
                headerTintColor: 'white', 
                headerTitleStyle: {
                    fontWeight: 'bold',    
                    fontSize: 20,      
                }
            })} 
        />
    </Stack.Navigator>
  )
}

export default MatriculaStackNav

const styles = StyleSheet.create({})