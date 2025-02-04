import React from 'react';
import { SafeAreaView, Text, View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import TresTabsNavigation from './src/navigation/TresTabsNavigation';
import ListaMatriculasScreen from './src/screens/MatriculasScreen';


const App = () => {
  return (
    <View style={{flex: 1}}>
      <TresTabsNavigation />
    </View>
  );
};

export default App;
