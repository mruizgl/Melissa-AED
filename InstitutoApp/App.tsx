import 'react-native-gesture-handler';
import React, { useContext } from 'react';
import { View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { AppProvider, AppContext } from './src/context/AppContext';
import TresTabsNavigation from './src/navigation/TresTabsNavigation';
import LoginScreen from './src/screens/LoginScreen';

const App = () => {
  const { isAuthenticated } = useContext(AppContext)!;

  return (
    <View style={{ flex: 1 }}>
      <NavigationContainer>
        {isAuthenticated ? <TresTabsNavigation /> : <LoginScreen />}
      </NavigationContainer>
    </View>
  );
};

// Aquí envolvemos App con AppProvider para que el contexto esté disponible globalmente
export default () => (
  <AppProvider>
    <App />
  </AppProvider>
);
