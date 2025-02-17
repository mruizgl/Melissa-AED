/* eslint-disable */
import React, { useEffect, useState } from "react";
import { useUser } from "../context/UserContext";
import { useGame } from "../context/GameContext";
import { createGame, findAvailableGame, joinGame } from "../api/api";
import { useNavigate } from "react-router-dom";

const Menu: React.FC = () => {
    const { user } = useUser();
    const { game, setGame } = useGame();
    const [searchingGame, setSearchingGame] = useState(false);
    const navigate = useNavigate();

    useEffect(() => {
        if (game?.status === "IN_PROGRESS") {
            console.log("✅ Partida iniciada, redirigiendo a /game");
            navigate("/game");
        }
    }, [game, navigate]);

    const handleFindGame = async () => {
        if (!user) {
            console.error("⚠️ No hay usuario autenticado.");
            return;
        }

        setSearchingGame(true);
        try {
            console.log("🔎 Buscando partidas disponibles...");
            const availableGame = await findAvailableGame();

            if (availableGame?.data && availableGame.data.status === "WAITING") {
                console.log(`✅ Se encontró una partida en espera: ID ${availableGame.data.id}`);
                const response = await joinGame(availableGame.data.id, user.id);
                console.log(`🎮 Jugador ${user.id} se unió a la partida: ID ${response.data.id}`);
                setGame(response.data);
            } else {
                console.log("❌ No hay partidas disponibles, creando una nueva...");
                const response = await createGame(user.id);
                console.log(`🆕 Nueva partida creada con ID: ${response.data.id}`);
                setGame(response.data);
            }
        } catch (error) {
            console.error("⚠️ Error al buscar o unirse a la partida:", error);
        } finally {
            setSearchingGame(false);
        }
    };

    if (!user) return <p className="text-center">Cargando usuario...</p>; 

    return (
        <div className="menu-container">
            <h2>Bienvenido, {user.username}</h2>
            <button onClick={handleFindGame} disabled={searchingGame}>
                {searchingGame ? "Buscando partida..." : "Jugar"}
            </button>
            {game?.status === "WAITING" && <p>Esperando a otro jugador...</p>}
        </div>
    );
};

export default Menu;

