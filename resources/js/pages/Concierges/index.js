import React, { useState, useEffect }  from 'react';
import { FaSearch, FaTrash } from 'react-icons/fa';

import './styles.css';
import api from '../../services/api';
import Header from '../../components/Header';

export default function Concierges() {
	const [mensage, setMensage] = useState(null);
	const [visitors, setVisitors] = useState([]);
	const [rooms, setRooms] = useState([]);

	const [selectedVisitor, setSelectedVisitor] = useState('');
	const [selectedRoom, setSelectedRoom] = useState('');
	const [selectedCheckIn, setSelectedCheckIn] = useState('');

	const [concierges, setConcierges] = useState([]);

    useEffect(() => {
        api.get('visitors').then(response => {
            setVisitors(response.data)
        })
	}, []);
	
	useEffect(() => {
        api.get('rooms').then(response => {
            setRooms(response.data)
        })
	}, []);

	function checkInputsForm(event) {	
		event.preventDefault();

		console.log(selectedVisitor, selectedRoom, selectedCheckIn);

		if (selectedVisitor === '' && selectedRoom === '' && selectedCheckIn === '') return setMensage('Selecione pelo menos um opção!');
		
		searchVisitors();
	};

	async function searchVisitors() {
		let concierge;

		try {
			concierge = await api.get(`concierges?visitor=${selectedVisitor}&room=${selectedRoom}&date=${selectedCheckIn}`);
		} catch (err) {
			alert('Erro ao tentar pesquisar as informações!\nTente novamente em alguns instantes!');
		}	

		if (concierge.data.length > 0) {
			setConcierges(concierge.data);
		} else {
			setConcierges([]);
			return setMensage('Não há registros nessa pesquisa. Tente novamente!');
		}
	};

	function handleClearFilter() {
		setConcierges([]);
	}

    return	( 
		<>
			<Header />

			<div className="container">
				<div className="contentMain">
					<div className="contentConcierge">
						<form onSubmit={checkInputsForm}>
							<div className="field-group">
								<div className="field">
									<select 
										id="visitor" 
										name="visitor"
										value={selectedVisitor} 
										onChange={e => setSelectedVisitor(e.target.value)}
									>
										<option value="">Selecione um Visitante</option>
										{visitors.map(visitor => (
											<option key={visitor.id} value={visitor.id}>{visitor.name}</option>
										))}
									</select>
								</div>
								<div className="field">
									<select 
										id="room" 
										name="room"
										value={selectedRoom} 
										onChange={e => setSelectedRoom(e.target.value)}
									>
										<option value="">Selecione uma Sala</option>
										{rooms.map(room => (
											<option key={room.id} value={room.id}>{room.nrRoom}</option>
										))}
									</select>
								</div>
							</div>

							<div className="field-group">
								<div className="field">
									<label htmlFor="name">Selecione uma Data</label>
									<input 
										id="checkIn" 
										name="checkIn"
										value={selectedCheckIn}
										type="date"
										placeholder="Selecione uma DATA DE CHECKIN"
										onChange={e => setSelectedCheckIn(e.target.value)}
									/>
								</div>
								<div className="btnsConcierge">	
									<span>
										<FaTrash size="24" title="Limpar" />
									</span>
									<button type="reset" onClick={handleClearFilter}>
										<strong>Limpar</strong>
									</button>

									<span>
										<FaSearch size="24" title="Pesquisar" />
									</span>
									<button type="submit" onClick={() => {}}>
										<strong>Pesquisar</strong>
									</button>
								</div>	
							</div>
						</form>
					</div>

					<div className="contentConcierges">					
						<ul>
							<li className="titleFilteredConcierges">
								<div style={{ width: '30px' }}>Nr</div>
								<div style={{ width: '250px' }}>Nome do Visitante</div>
								<div style={{ width: '120px' }}>CPF</div>
								<div style={{ width: '60px' }}>Nr Sala</div>
								<div style={{ width: '200px' }}>Data e Hora do CheckIn</div>
								<div style={{ width: '200px' }}>Data e Hora do CkeckOut</div>
							</li>
							{concierges.map((concierge, index )=> (
								<li key={concierge.id} className="contentFilteredConcierges">
									<h3>{index + 1}</h3>
									<header>{concierge.name}</header>
									<span>{concierge.cpf}</span>
									<h4>{concierge.nrRoom}</h4>
									<p>{concierge.checkIn}</p>
									<p>{concierge.checkOut}</p>
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
