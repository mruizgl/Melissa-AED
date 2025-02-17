import React, { createContext, useContext, useState, useEffect, ReactNode } from "react";
import { getGameState } from "../api/api";

export interface Game {
    id: number;
    player1: number | null;
    player2: number | null;
    boardState: string[][];
    currentPlayer: number;
    winner: number | null;
    status: string;
}

interface GameState {
    game: Game | null;
    setGame: (game: Game) => void;
}

export const GameContext = createContext<GameState | null>(null);

export const GameProvider = ({ children }: { children: ReactNode }) => {
    const [game, setGame] = useState<Game | null>(null);
    useEffect(() => {
        const interval = setInterval(() => {
            if (game && game.id) {
                getGameState(game.id)
                    .then(response => setGame(response.data))
                    .catch(error => console.error("Error al actualizar el juego:", error));
            }
        }, 500);

        return () => clearInterval(interval);
    }, [game]);

    return (
        <GameContext.Provider value={{ game, setGame }}>
            {children}
        </GameContext.Provider>
    );
};

export const useGame = () => {
    const context = useContext(GameContext);
    if (!context) {
        throw new Error("useGame debe usarse dentro de un GameProvider");
    }
    return context;
};
