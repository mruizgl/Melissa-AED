import React, { useState } from "react";
import { useUser } from "../context/UserContext";
import { loginUser, registerUser } from "../api/api";
import { useNavigate } from "react-router-dom"; 
import "../styles/auth.css";

const Auth: React.FC = () => {
    const { setUser } = useUser();
    const navigate = useNavigate(); 
    const [formData, setFormData] = useState({ email: "", username: "", password: "" });
    const [error, setError] = useState("");
    const [isRegister, setIsRegister] = useState(false);


    const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };



    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setError("");

        try {
            let userData;
            if (isRegister) {
                userData = await registerUser(formData.email, formData.username, formData.password);
            } else {
                userData = await loginUser(formData.username, formData.password);
            }

            setUser(userData.data);
            navigate("/menu"); 
        } catch (err) {
            setError("Error en la autenticación. Verifica tus credenciales.");
        }
    };


    return (
        <div className="auth-container">
            <h2>Iniciar Sesión</h2>

            {error && <p className="error">{error}</p>}

            <form onSubmit={handleSubmit}>
                <input type="text" name="username" placeholder="Usuario" value={formData.username} onChange={handleChange} required />
                <input type="password" name="password" placeholder="Contraseña" value={formData.password} onChange={handleChange} required />
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    );
};

export default Auth;
