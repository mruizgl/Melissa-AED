import React from "react";
import { useGame } from "../context/GameContext";
import { useUser } from "../context/UserContext";
import { makeMove } from "../api/api";

const Board: React.FC = () => {
    const { game, setGame } = useGame();
    const { user } = useUser();

    if (!game) return <p className="text-center text-xl font-semibold">Cargando juego...</p>;

    const handleMove = async (row: number, col: number) => {
        if (!user || game.winner || game.boardState[row][col]) return;

        try {
            const updatedGame = await makeMove(game.id, row, col, user.id);
            setGame(updatedGame.data);
        } catch (error) {
            console.error("Error al hacer el movimiento", error);
        }
    };

    return (
        <div className="game-container">
            <h2>Tres en Raya</h2>
            
            <div className="board">
                {game.boardState.map((row, rowIndex) => (
                    <div key={rowIndex} className="row">
                        {row.map((cell, colIndex) => (
                            <button
                                key={`${rowIndex}-${colIndex}`}
                                className="cell"
                                disabled={Boolean(cell) || Boolean(game.winner)} 
                                onClick={() => handleMove(rowIndex, colIndex)}
                            >
                                {cell}
                            </button>
                        ))}
                    </div>
                ))}
            </div>

            {/* Mostrar el ganador si la partida ha finalizado */}
            {game.winner && (
                <p className="winner-message">
                    🎉 ¡Jugador {game.winner} ha ganado! 🎉
                </p>
            )}
        </div>
    );
};

export default Board;
