let rota = 'http://localhost:8000/api';

async function readRoute(url){
    let resp = await fetch(url);
    if (resp.status !== 200) {
        let data = await resp.json();
        console.log('data: ' + data);
    }
}
readRoute(rota);
