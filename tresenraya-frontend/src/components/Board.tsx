import React from "react";
import { useGame } from "../context/GameContext";
import { useUser } from "../context/UserContext";
import { makeMove } from "../api/api";
import "../styles/board.css"; 

const Board: React.FC = () => {
    const { game, setGame } = useGame();
    const { user } = useUser(); 

    if (!game) return <p className="loading-text">Cargando juego...</p>;

    const handleMove = async (row: number, col: number) => {
        if (game.boardState[row][col] || game.winner) return; 

        if (!user) {
            console.error("Error: No hay un usuario autenticado.");
            return;
        }

        try {
            const updatedGame = await makeMove(game.id, row, col, user.id);
            setGame(updatedGame.data);
        } catch (error) {
            console.error("Error al hacer el movimiento", error);
        }
    };

    return (
        <div className="board-container">
            <h2 className="title">Tres en Raya</h2>

            <div className="board">
                {game.boardState.map((row, rowIndex) => (
                    <div key={rowIndex} className="board-row">
                        {row.map((cell, colIndex) => (
                            <button
                                key={`${rowIndex}-${colIndex}`}
                                className="cell"
                                onClick={() => handleMove(rowIndex, colIndex)}
                            >
                                {cell || ""}
                            </button>
                        ))}
                    </div>
                ))}
            </div>

            {game.winner && (
                <p className="winner-message">
                    🎉 ¡Jugador {game.winner} ha ganado! 🎉
                </p>
            )}
        </div>
    );
};

export default Board;
