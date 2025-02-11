import { StyleSheet, Text, View } from 'react-native'
import React, { createContext, useState } from 'react'


type Props = {
  children: React.ReactNode;
}

type MatriculaContextType ={
    id: number,
    setId: (id: number) => void,
}

export const MatriculaContextHook = createContext<MatriculaContextType>({} as MatriculaContextType );


const MatriculaContext = (props: Props) => {
    const [id, setId] = useState<number>(-1);

    const contextValues: MatriculaContextType  = {
        id,
        setId,
    }

  return (
    <MatriculaContextHook.Provider value={contextValues}>
      {props.children}
    </MatriculaContextHook.Provider>
  )
}

export default MatriculaContext

const styles = StyleSheet.create({})