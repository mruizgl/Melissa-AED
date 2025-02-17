import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Auth from "./components/Auth";
import Menu from "./components/Menu";
import Board from "./components/Board";
import { GameProvider } from "./context/GameContext";
import { UserProvider } from "./context/UserContext";

const App: React.FC = () => {
    return (
        <UserProvider>
            <GameProvider>
                <Router>
                    <Routes>
                        <Route path="/" element={<Auth />} />
                        <Route path="/menu" element={<Menu />} />
                        <Route path="/game" element={<Board />} />
                    </Routes>
                </Router>
            </GameProvider>
        </UserProvider>
    );
};

export default App;
