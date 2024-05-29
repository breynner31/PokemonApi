
document.getElementById('searchButton').addEventListener('click', function() {
    const pokemonName = document.getElementById('pokemonInput').value.toLowerCase();
    let URL = `https://pokeapi.co/api/v2/pokemon/${pokemonName}`;

    fetch(URL)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red');
            }
            return response.json();
        })
        .then(data => {

            const resultDiv = document.getElementById('result');
            resultDiv.innerHTML = `
                <h2>${data.name.charAt(0).toUpperCase() + data.name.slice(1)}</h2>
                <img src="${data.sprites.front_default}" alt="${data.name}">
                <button class="ver-mas" onclick="verMas(${data.id})">Ver más</button>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('result').innerHTML = '<p>Hubo un error al buscar el Pokémon. Por favor, intenta nuevamente.</p>';
        });
});
