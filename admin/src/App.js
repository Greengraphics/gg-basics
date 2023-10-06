
import './App.css';

const useState = wp.element.useState;

const App = () => {

  const [option1, setOption1] = useState('');
  const [option2, setOption2] = useState('');

  return (
    <div className="App">
      <header className="App-header">
        <h1>GG Basics Settings</h1>
      </header>

      <div>
          <label>Options 1</label>
          <input
              value={option1}
              onChange={(event) => {
                setOption1(event.target.value);
              }}
          />
        </div>

        <div>
          <label>Options 2</label>
          <input
              value={option2}
              onChange={(event) => {
                setOption2(event.target.value);
              }}
          />
        </div>

    </div>
  );
}

export default App;
