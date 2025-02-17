import React, { useEffect } from "react";
import { getGameState } from "./api/api";

const TestApi = () => {
    useEffect(() => {
        getGameState(1)
            .then((response: { data: any }) => console.log("Game data:", response.data))
            .catch((error: any) => console.error("Error fetching game:", error));
    }, []);

    return <div>Revisar consola para ver la respuesta de la API.</div>;
};

export default TestApi;
