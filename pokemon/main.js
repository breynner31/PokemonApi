const listaPokemon = document.querySelector("#listaPokemon");
let URL = "https://pokeapi.co/api/v2/pokemon/";

for (let i = 1; i <= 1000; i++) {
    fetch(URL + i)
        .then((response) => response.json())
        .then(data => mostrarPokemon(data));
}

function mostrarPokemon(pokemon) {
    let tipos = pokemon.types.map(type => ` <p class="${type.type.name} tipo">${type.type.name}</p>`);
    tipos = tipos.join('');

    const div = document.createElement("div");
    div.classList.add("pokemon");
    div.innerHTML = `
        <p class="pokemon-id-back">00${pokemon.id}</p>
        <div class="pokemon-imagen">
            <img src="${pokemon.sprites.front_default}" alt="${pokemon.name}">
        </div>
        <div class="pokemon-info">
            <div class="nombre-contenedor">
                <p class="pokemon-id">${pokemon.id}</p>
                <h2 class="pokemon-nombre">${pokemon.name}</h2>
            </div>
         
     
            <button class="ver-mas" onclick="verMas(${pokemon.id})">Ver más</button>
        </div>
    `;
    listaPokemon.append(div);
}

function verMas(id) {
    window.location.href = `ver-mas.html?id=${id}`;
}
