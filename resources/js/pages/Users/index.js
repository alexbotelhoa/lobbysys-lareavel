import React, { useState, useEffect } from 'react';
import { RiDeleteBinLine } from 'react-icons/ri';
import { FiSave } from 'react-icons/fi';

import './styles.css';
import api from '../../services/api';
import Header from '../../components/Header';

export default function Users() {
    const [mensage, setMensage] = useState(null);
    const [users, setUsers] = useState([]);

    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [passwordConfirm, setPasswordConfirm] = useState('');

    useEffect(() => {
        api.get('users').then(response => {
            setUsers(response.data)
        })
    }, []);

    function checkInputsForm(event) {
        event.preventDefault();

        if (name === '') return setMensage('Informe o nome do usuário!');
        if (email === '') return setMensage('Informe o e-mail do usuário!');
        if (password === '') return setMensage('Informe o password do visitante!');
        if (passwordConfirm === '') return setMensage('Confirme o password informado!');
        if (password !== passwordConfirm) return setMensage('As senhas não se correpondem!');

        createUser();
    }

    async function createUser() {
        const data = new FormData();
        data.append('name', name);
        data.append('email', email);
        data.append('password', password);

        let user;

        try {
            user = await api.post('users', data);
        } catch (err) {
            alert('Erro ao tentar ADICIONAR o usuário!\nVerifique se esse E-MAIL já foi cadastrado.\nCaso não, tente novamente em alguns instantes!');
        }

        if (user.status === 201) {
            setUsers([ user.data, ...users ]);
        } else {
            if (user.status === 226) return setMensage('Usuário já se encontra cadastrado!');
        }
    }

    async function handleDeleteUser(id) {
        try {
            await api.delete(`/users/${id}`);

            setUsers(users.filter(user => user.id !== id));
        } catch (err) {
            alert('Erro ao tentar DELETAR o usuário!\nVerifique se esse E-MAIL contém registro(s) de "checkin".\nCaso não tenha, tente novamente em alguns instantes!');
        }
    }

    return	(
		<>
			<Header />

			<div className="container">
				<div className="contentMain">
					<div className="contentUser">
						<form onSubmit={checkInputsForm}>
							<div className="field-group">
								<div className="field">
									<label htmlFor="name">Nome * (Máximo de 20 caracteres)</label>
									<input
										id="name"
										name="name"
										type="text"
										maxLength="20"
										placeholder="Informe seu NOME"
										value={name}
										onChange={e => setName(e.target.value)}
									/>
								</div>

								<div className="field">
									<label htmlFor="email">E-mail *</label>
									<input
										id="email"
										name="email"
										type="email"
										placeholder="Informe seu E-MAIL"
										value={email}
										onChange={e => setEmail(e.target.value)}
									/>
								</div>
							</div>

							<div className="field-group">
								<div className="field">
									<label htmlFor="password">Password *</label>
									<input
										id="password"
										name="password"
										type="password"
										placeholder="Informe uma SENHA"
										value={password}
										onChange={e => setPassword(e.target.value)}
									/>
								</div>
								<div className="field">
									<label htmlFor="password-confirm">Confirme Password *</label>
									<input
										id="passwordConfirm"
										name="passwordConfirm"
										type="password"
										placeholder="Confirme sua SENHA"
										value={passwordConfirm}
										onChange={e => setPasswordConfirm(e.target.value)}
									/>
								</div>
							</div>
							<div className="btnSalveUser">
									<span>
										<FiSave size="26" title="Novo Usuário" />
									</span>
								<button type="submit" onClick={() => {}}>
									<strong>Cadastrar novo usuário</strong>
								</button>
							</div>
						</form>
					</div>

					<div className="contentUsers">
						<ul>
							{users.map((user, index) => (
								<li key={user.id}>
									<h3>{index + 1}</h3>
									<header>{user.name}</header>
									<footer>{user.email}</footer>
									<button onClick={() => handleDeleteUser(user.id)}>
										<RiDeleteBinLine size="16" />
									</button>
								</li>
							))}
						</ul>
					</div>
				</div>
			</div>

			{ mensage && (
				<div className="validation-container">
					<strong className="mensageError">{mensage}</strong>
					<button type="button" onClick={() => setMensage(null)}>FECHAR</button>
				</div>
			) }
		</>
	)
}
