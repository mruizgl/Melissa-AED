import React, { createContext, useContext, useState, ReactNode } from "react";
import { useUser } from "./UserContext";

export interface Game {
    id: number;
    player1: number | null;
    player2: number | null;
    boardState: (string | null)[][];
    currentPlayer: number; 
    winner: number | null;
}

interface GameState {
    game: Game;
    setGame: (game: Game) => void;
}

const GameContext = createContext<GameState | undefined>(undefined);

export const GameProvider = ({ children }: { children: ReactNode }) => {
    const { user } = useUser(); 
    const [game, setGame] = useState<Game>({
        id: 0,
        player1: user?.id ?? null, 
        player2: null,
        boardState: [
            [null, null, null],
            [null, null, null],
            [null, null, null],
        ],
        currentPlayer: user?.id ?? 1, 
        winner: null,
    });

    return (
        <GameContext.Provider value={{ game, setGame }}>
            {children}
        </GameContext.Provider>
    );
};


export const useGame = () => {
    const context = useContext(GameContext);
    if (!context) {
        throw new Error("useGame debe ser usado dentro de un GameProvider");
    }
    return context;
};
