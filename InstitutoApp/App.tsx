import * as React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createStackNavigator } from '@react-navigation/stack';
import LoginScreen from './src/screens/LoginScreen';
import RegisterScreen from './src/screens/RegisterScreen';
import ProfileScreen from './src/screens/ProfileScreen';
import MatriculasScreen from './src/screens/MatriculasScreen';
import SearchMatriculasScreen from './src/screens/SearchMatriculasScreen';

const Stack = createStackNavigator();
const Tab = createBottomTabNavigator();

const HomeTabs: React.FC = () => (
  <Tab.Navigator>
    <Tab.Screen name="Profile" component={ProfileScreen} />
    <Tab.Screen name="Matriculas" component={MatriculasScreen} />
    <Tab.Screen name="Search" component={SearchMatriculasScreen} />
  </Tab.Navigator>
);

const App: React.FC = () => (
  <NavigationContainer>
    <Stack.Navigator>
      <Stack.Screen name="Login" component={LoginScreen} />
      <Stack.Screen name="Register" component={RegisterScreen} />
      <Stack.Screen name="Home" component={HomeTabs} />
    </Stack.Navigator>
  </NavigationContainer>
);

export default App;