import React, { createContext, useState, ReactNode } from 'react';

interface AuthContextType {
  isAuthenticated: boolean;
  setIsAuthenticated: React.Dispatch<React.SetStateAction<boolean>>;
  token: string | null;
  login: (token: string) => void;
  logout: () => void;
}

export const AppContext = createContext<AuthContextType | undefined>(undefined);

export const AppProvider = ({ children }: { children: ReactNode }) => {
  const [isAuthenticated, setIsAuthenticated] = useState<boolean>(false);
  const [token, setToken] = useState<string | null>(null);

  const login = (newToken: string) => {
    setIsAuthenticated(true);
    setToken(newToken);
  };

  const logout = () => {
    setIsAuthenticated(false);
    setToken(null);
  };

  return (
    <AppContext.Provider value={{ isAuthenticated, setIsAuthenticated, token, login, logout }}>
      {children}
    </AppContext.Provider>
  );
};
