import { useEffect, useState } from 'react';

function App() {
  const [tareas, setTareas] = useState([]);
  const [titulo, setTitulo] = useState('');
  const [descripcion, setDescripcion] = useState('');

  // 1. Obtener las tareas desde la API de Laravel (GET)
  const obtenerTareas = async () => {
    try {
      const response = await fetch('http://localhost:8002/api/tareas');
      const data = await response.json();
      setTareas(data.data || []);
    } catch (error) {
      console.error('Error al obtener las tareas:', error);
    }
  };

  useEffect(() => {
    obtenerTareas();
  }, []);

  // 2. Crear una nueva tarea (POST)
  const agregarTarea = async (e) => {
    e.preventDefault();
    if (!titulo.trim()) return;

    try {
      const response = await fetch('http://localhost:8002/api/tareas', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify({
          titulo,
          descripcion,
          completada: 0,
        }),
      });

      if (response.ok) {
        setTitulo('');
        setDescripcion('');
        obtenerTareas();
      }
    } catch (error) {
      console.error('Error al agregar la tarea:', error);
    }
  };

  // 3. Eliminar una tarea (DELETE)
  const eliminarTarea = async (id) => {
    try {
      const response = await fetch(`http://localhost:8002/api/tareas/${id}`, {
        method: 'DELETE',
      });

      if (response.ok) {
        obtenerTareas();
      }
    } catch (error) {
      console.error('Error al eliminar la tarea:', error);
    }
  };

  return (
    <div style={{ maxWidth: '600px', margin: '40px auto', fontFamily: 'sans-serif', padding: '20px' }}>
      <h2>Gestor de Tareas (React + Laravel API)</h2>

      <form onSubmit={agregarTarea} style={{ marginBottom: '20px', display: 'flex', flexDirection: 'column', gap: '10px' }}>
        <input
          type="text"
          placeholder="Título de la tarea"
          value={titulo}
          onChange={(e) => setTitulo(e.target.value)}
          style={{ padding: '8px', fontSize: '16px' }}
        />
        <input
          type="text"
          placeholder="Descripción"
          value={descripcion}
          onChange={(e) => setDescripcion(e.target.value)}
          style={{ padding: '8px', fontSize: '16px' }}
        />
        <button type="submit" style={{ padding: '10px', backgroundColor: '#007bff', color: '#fff', border: 'none', cursor: 'pointer' }}>
          Agregar Tarea
        </button>
      </form>

      <ul style={{ listStyle: 'none', padding: 0 }}>
        {tareas.map((tarea) => (
          <li
            key={tarea.id}
            style={{
              padding: '12px',
              border: '1px solid #ccc',
              borderRadius: '4px',
              marginBottom: '10px',
              display: 'flex',
              justifyContent: 'space-between',
              alignItems: 'center',
            }}
          >
            <div>
              <strong>{tarea.titulo}</strong>
              <p style={{ margin: '4px 0 0', color: '#666' }}>{tarea.descripcion}</p>
            </div>
            <button
              onClick={() => eliminarTarea(tarea.id)}
              style={{ backgroundColor: '#dc3545', color: '#fff', border: 'none', padding: '6px 12px', cursor: 'pointer' }}
            >
              Eliminar
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
}

// ESTA LÍNEA ES IMPRESCINDIBLE AL FINAL:
export default App;