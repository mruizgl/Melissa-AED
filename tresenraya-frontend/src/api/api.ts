import axios from "axios";

const API_BASE_URL = "http://localhost:8080"; 


export const registerUser = async (email: string, username: string, password: string) => {
    return axios.post(`${API_BASE_URL}/users/register`, { email, username, password });
};


export const loginUser = async (email: string, password: string) => {
    return axios.post(`${API_BASE_URL}/users/login`, { email, password });
};


export const createGame = async (player1Id: number) => {
    return axios.post(`${API_BASE_URL}/games/new`, null, { params: { player1Id } });
};


export const joinGame = async (gameId: number, player2Id: number) => {
    return axios.post(`${API_BASE_URL}/games/${gameId}/join`, null, { params: { player2Id } });
};


export const makeMove = async (gameId: number, row: number, col: number, playerId: number) => {
    return axios.post(`${API_BASE_URL}/games/${gameId}/move`, null, {
        params: { row, col, playerId }
    });
};


export const getGameState = async (gameId: number) => {
    return axios.get(`${API_BASE_URL}/games/${gameId}`);
};


export const spectateGame = async (gameId: number) => {
    return axios.get(`${API_BASE_URL}/games/${gameId}/spectate`);
};
