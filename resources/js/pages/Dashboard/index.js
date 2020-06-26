import React, { useState, useEffect } from 'react';
import { GiExitDoor } from 'react-icons/gi';
import { FaAddressCard } from 'react-icons/fa';
import { BsBoxArrowRight } from 'react-icons/bs';

import './styles.css';
import api from '../../services/api';
import Header from '../../components/Header';
import person from '../../assets/person.png'

export default function Dashboard() {
	const [mensage, setMensage] = useState(null);
	const [visitors, setVisitors] = useState([]);
	const [rooms, setRooms] = useState([]);
	const [arrivals, setArrivals] = useState([]);
	const [queues, setQueues] = useState([]);

	const [selectedVisitor, setSelectedVisitor] = useState('0');
	const [selectedRoom, setSelectedRoom] = useState('0');

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
	
	useEffect(() => {
		loadArrivals();
	}, []);
	
	useEffect(() => {
		loadQueues();
    }, []);

	function loadArrivals() {
		api.get('arrivals').then(response => {
			setArrivals(response.data)
		});
	};

	function loadQueues() {
		api.get('queues').then(response => {
			setQueues(response.data)
		});
	};

	function checkInputsForm(event) {	
		event.preventDefault();

		if (selectedVisitor === '0') return setMensage('Selecione um visitante!');

		if (selectedRoom === '0') return setMensage('Selecione uma sala!');
		
		createPositionArrival();
	};

	async function createPositionArrival() {
		const visitor = selectedVisitor.split(',');
		const room = selectedRoom.split(',');
		const dataTime = new Date().toLocaleString();

		const data = new FormData();
		data.append('visitor_id', visitor[0]);
        data.append('room_id', room[0]);
        data.append('checkIn', dataTime);

		let arrival;

		try {
			arrival = await api.post('arrivals', data);
		} catch (err) {
			alert('Erro ao tentar realizar o CHECKIN do visitante!\nTente novamente em alguns instantes!');
		};

		if (arrival.status === 201) {
			const nameVisitorAndNrRoom = [{
				name: visitor[1],
				nrRoom: room[1]
			}];

			Object.assign(arrival.data, nameVisitorAndNrRoom[0]);

			setArrivals([ ...arrivals, arrival.data ]);
		} else {
			if (arrival.status === 226) return setMensage('Visitante já está cadastrado nessa sala!');

			createPositionQueue(data, visitor[1], room[1]);
		}
	}

	async function createPositionQueue(data, name, nrRoom) {
		let queue;

		try {
			queue = await api.post('queues', data);
		} catch (err) {
			alert('Erro ao tentar realizar o CHECKIN do visitante!\nTente novamente em alguns instantes!');
		}

		if (queue.status === 201) {
			const nameVisitorAndNrRoom = [{
				name: name,
				nrRoom: nrRoom
			}];

			Object.assign(queue.data, nameVisitorAndNrRoom[0])

			setQueues([ ...queues, queue.data ]);
		} else {
			if (queue.status === 203) return setMensage('Visitante já se encontra na fila de espera!');
		}
	}

	async function handleCheckOut(id) {
		let arrival;

		try {
			arrival = await api.delete(`/arrivals/${id}`);
		} catch (err) {
			alert('Erro ao tentar realizar o CHECKOUT do visitante!\nTente novamente em alguns instantes!');
		}
		
		if (arrival.status === 201)  {
			loadArrivals();

			loadQueues();
		} else {
			setArrivals(arrivals.filter(arrival => arrival.id !== id));
		}		
	};
	
	async function handleExitQueue(id) {
		try {
			await api.delete(`/queues/${id}`);

			setQueues(queues.filter(queue => queue.id !== id));
		} catch (err) {
			alert('Erro ao tentar RETIRAR o visitante da fila de espera!\nTente novamente em alguns instantes!');
		}
    };	

	return	( 
		<>
			<Header />
			
			<div className="containerMain">
				<div className="contentLeft">
					<div className="contentDashboardVisitors">
						<form onSubmit={checkInputsForm}>
							<select 
								id="visitor" 
								name="visitor"
								value={selectedVisitor} 
								onChange={e => setSelectedVisitor(e.target.value)}
							>
								<option value="0">Selecione um Visitante</option>
								{visitors.map(visitor => (
									<option key={visitor.id} value={[visitor.id, visitor.name]}>{visitor.name}</option>
								))}
							</select>

							<select 
								id="room" 
								name="room"
								value={selectedRoom} 
								onChange={e => setSelectedRoom(e.target.value)}
							>
								<option value="0">Selecione uma Sala</option>
								{rooms.map(room => (
									<option key={room.id} value={[room.id, room.nrRoom]}>{room.nrRoom}</option>
								))}
							</select>

							<button className="btnCheckin" type="submit">
								<FaAddressCard size="26" title="CkeckIn" />
							</button>
						</form>
					</div>
					<div className="contentDashboardRooms">
						<ul>
						{arrivals.map(arrival => (
							<li className="cardPerson" key={arrival.id}>
								<span>
									<img src={person} title="Visitante" alt="" />
								</span>
								<footer>
									<strong>Sala {arrival.nrRoom}</strong>
									<p>{arrival.name}</p>
									<h6>{arrival.checkIn}</h6>
								</footer>
								<button className="btnCard" onClick={() => handleCheckOut(arrival.id)}>
									<BsBoxArrowRight size="26" title="CheckOut" />
								</button>
							</li>							
						))}
						</ul>
					</div>
				</div>

				<div className="contentRight">
					<div className="contentDashboardQueues">
						<p>Fila de Esperaa</p>
					</div>
					<div className="queuePerson">
						<ul>
							{queues.map(queue => (
								<li className="cardPerson" key={queue.id}>
									<span>
										<img src={person} alt="" />
									</span>
									<footer>
										<strong>Sala {queue.nrRoom}</strong>
										<p>{queue.name}</p>
										<h6>{queue.create_at}</h6>						
									</footer>
									<button className="btnCard" onClick={() => handleExitQueue(queue.id)}>
										<GiExitDoor size="26" title="Exit" />
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
