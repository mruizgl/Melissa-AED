import React from 'react';
import { SafeAreaView, Text } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Icon from 'react-native-vector-icons/Ionicons';
import ListaMatriculasScreen from '../screens/MatriculasScreen';
import LoginScreen from '../screens/LoginScreen';

const Screen1 = () => (
  <SafeAreaView>
    <Text>Pestaña 1</Text>
  </SafeAreaView>
);

const Screen3 = () => (
  <SafeAreaView>
    <Text>Pestaña 3</Text>
  </SafeAreaView>
);

const Tab = createBottomTabNavigator();

const TresTabsNavigation = () => {
  return (
    <NavigationContainer>
      <Tab.Navigator
        screenOptions={({ route }) => ({
          tabBarIcon: ({ color, size }) => {
            let iconName = '';

            if (route.name === 'Perfil') {
              iconName = 'person'; 
            } else if (route.name === 'Matrículas') {
              iconName = 'list'; 
            } else if (route.name === 'Buscar') {
              iconName = 'search'; 
            }

            return <Icon name={iconName} size={size} color={color} />;
          },
        })}
      >
        <Tab.Screen name="Perfil" component={LoginScreen} />
        <Tab.Screen name="Matrículas" component={ListaMatriculasScreen} />
        <Tab.Screen name="Buscar" component={Screen3} />
      </Tab.Navigator>
    </NavigationContainer>
  );
};

export default TresTabsNavigation;
