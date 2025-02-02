import React from 'react';
import { SafeAreaView, Text } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';

const Screen1 = () => (
  <SafeAreaView>
    <Text>Pestaña 1</Text>
  </SafeAreaView>
);

const Screen2 = () => (
  <SafeAreaView>
    <Text>Pestaña 2</Text>
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
      <Tab.Navigator>
        <Tab.Screen name="Tab1" component={Screen1} />
        <Tab.Screen name="Tab2" component={Screen2} />
        <Tab.Screen name="Tab3" component={Screen3} />
      </Tab.Navigator>
    </NavigationContainer>
  );
};

export default TresTabsNavigation;
