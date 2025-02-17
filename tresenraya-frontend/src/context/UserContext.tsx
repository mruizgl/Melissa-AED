import React, { createContext, useContext, useState, ReactNode } from "react";

export interface User {
    id: number;
    email: string;
    username: string;
}

interface UserState {
    user: User | null;
    setUser: (user: User) => void;
}


const UserContext = createContext<UserState | undefined>(undefined);

export const UserProvider = ({ children }: { children: ReactNode }) => {
    const [user, setUser] = useState<User | null>(null);

    return (
        <UserContext.Provider value={{ user, setUser }}>
            {children}
        </UserContext.Provider>
    );
};

export const useUser = () => {
    const context = useContext(UserContext);
    if (!context) {
        throw new Error("useUser debe ser usado dentro de un UserProvider");
    }
    return context;
};
