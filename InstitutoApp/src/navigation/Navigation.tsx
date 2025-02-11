import { View, Text } from 'react-native'
import React from 'react'
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import LoginScreen from '../screens/LoginScreen';

type RootStackParamList = {
    Login: undefined,
    Tercera: undefined,
    Navigation: undefined,
  }
  
  const Stack = createNativeStackNavigator<RootStackParamList>();
  
function Navigation(): React.JSX.Element {


  

    return (
      <Stack.Navigator>
          <Stack.Screen name="Login" component={LoginScreen} />
          <Stack.Screen name="Tercera" component={LoginScreen} />
          <Stack.Screen name="Navigation" component={LoginScreen} />
      </Stack.Navigator>
      
  
    );
  }
  
  
  
  export default Navigation;