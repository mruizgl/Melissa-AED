import React from 'react';
import { SafeAreaView, Text, View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import TresTabsNavigation from './src/navigation/TresTabsNavigation';


const App = () => {
  return (
    <View style={{flex: 1}}>
      <Text>¡Hola mundo!</Text>
      <TresTabsNavigation />
    </View>
  );
};

export default App;
