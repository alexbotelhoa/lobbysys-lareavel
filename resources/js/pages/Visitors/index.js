import React, { useState, useEffect }  from 'react';
import { RiDeleteBinLine } from 'react-icons/ri';
import { FiSave } from 'react-icons/fi';
import InputMask from 'react-input-mask';

import './styles.css';
import api from '../../services/api';
import Header from '../../components/Header';

export default function Visitors() {
	const [mensage, setMensage] = useState(null);
	const [visitors, setVisitors] = useState([]);

	const [name, setName] = useState('');
	const [cpf, setCpf] = useState('');
	const [birth, setBirth] = useState('');
	const [email, setEmail] = useState('');

	useEffect(() => {
        api.get('visitors').then(response => {
            setVisitors(response.data)
        })
	}, []);

	function checkInputsForm(event) {	
		event.preventDefault();

		if (name === '') return setMensage('Informe o nome do visitante!');
		if (cpf === '') return setMensage('Informe o CPF do visitante!');
		
		createVisitor();
	};

	async function createVisitor() {
		const data = new FormData();
		data.append('name', name);
        data.append('cpf', cpf);
        data.append('birth', birth);
		data.append('email', email);
		
		let visitor;

		try {
			visitor = await api.post('visitors', data);
		} catch (err) {
			alert('Erro ao tentar ADICIONAR o visitante!\nVerifique se o CPF já foi cadastrado.\nCaso não, tente novamente em alguns instantes!');
		}	

		if (visitor.status === 201) {
			setVisitors([ visitor.data, ...visitors ]);
		} else {
			if (visitor.status === 226) return setMensage('Visitante já se encontra cadastrado!');
		}
	}

	async function handleDeleteVisitor(id) {
        try {
            await api.delete(`/visitors/${id}`);
        
            setVisitors(visitors.filter(visitor => visitor.id !== id));
        } catch (err) {
			alert('Erro ao tentar DELETAR o visitante!\nVerifique se o visitante contém registro(s) de "checkin".\nCaso não tenha, tente novamente em alguns instantes!');
        }
	};
	
    return	( 
		<>
			<Header />

			<div className="container">
				<div className="contentMain">
					<div className="contentVisitor">
						<form onSubmit={checkInputsForm}>						
							<div className="field-group">
								<div className="field">
									<label htmlFor="name">Nome *</label>
									<input 
										id="name" 
										name="name"
										value={name}
										type="text"
										maxLength="50"
										placeholder="Informe seu NOME"
										onChange={e => setName(e.target.value)}
									/>
								</div>
								<div className="field">
									<label htmlFor="cpf">CPF *</label>
									<InputMask 
										id="cpf" 
										name="cpf"
										value={cpf}
										mask="999.999.999-99"
										maskChar=""
										placeholder="Informe seu CPF"
										onChange={e => setCpf(e.target.value)}
									/>
								</div>
							</div>

							<div className="field-group">
								<div className="field">
									<label htmlFor="birth">Data de Nascimento</label>
									<input 
										id="birth" 
										name="birth"
										value={birth}
										type="date"
										placeholder="Informe sua DATA DE NASCIMENTO"
										onChange={e => setBirth(e.target.value)}
									/>
								</div>
								<div className="field">
									<label htmlFor="email">E-mail</label>
									<input 
										id="email" 
										name="email"
										value={email}
										type="email"
										placeholder="Informe seu E-MAIL"
										onChange={e => setEmail(e.target.value)}
									/>
								</div>
							</div>							
							<div className="btnSalveVisitor">	
								<span>
									<FiSave size="26" title="Novo Visitante" />
								</span>
								<button type="submit" onClick={() => {}}>
									<strong>Cadastrar novo visitante</strong>
								</button>
							</div>															
						</form>
					</div>

					<div className="contentVisitors">			
						<ul>
							{visitors.map((visitor, index) => (
								<li key={visitor.id}>
									<h3>{index + 1}</h3>
									<header>{visitor.name}</header>
									<p>{visitor.cpf}</p>
									<span>{visitor.birth}</span>
									<footer>{visitor.email}</footer>
									<button onClick={() => handleDeleteVisitor(visitor.id)}>
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
