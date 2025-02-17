import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Auth from "./components/Auth";
import Board from "./components/Board";
import { GameProvider } from "./context/GameContext";
import { UserProvider } from "./context/UserContext";

const App: React.FC = () => {
    return (
        <Router>
            <UserProvider>
                <GameProvider>
                    <Routes>
                        <Route path="/" element={<Auth />} />
                        <Route path="/board" element={<Board />} />
                    </Routes>
                </GameProvider>
            </UserProvider>
        </Router>
    );
};

export default App;
