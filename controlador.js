var produtos=[]; 
var produtoSelecionado;
const url='../back/api/produto.php';

function obtemProdutos()
{
	axios(
		{
		method:'GET',
		url: url,
		responseType:'json'
		}).then(res=>{
	//	console.log(res.data),
		produtos = res.data;
		preencheTabela()
		}
	).catch(error=>{
		console.error(error);
	});
}

obtemProdutos();

function preencheTabela(){
	
	document.querySelector('#tabela-produtos tbody').innerHTML ='';
	for(let i=0;i<produtos.length;i++){
	//	alert(i);
		document.querySelector('#tabela-produtos tbody').innerHTML += 
		`<tr>
		<td>${produtos[i].produto}</td>
		<td>${produtos[i].valor}</td>
		<td>${produtos[i].data_compra}</td>
		<td>${produtos[i].tipo}</td>
		<td><button type='buton' onclick='deletaProduto(${i})'>X</button>
		<button type='buton' onclick='selecionar(${i})'>Editar</button>
		</td></tr>`; //inserir esse id no html
	}
}

function deletaProduto(indice){//elimna
	console.log('Deletar o elemento com o indice '+indice);
axios(
		{
		method:'DELETE',
		url: url+`?id=${indice}`,
		responseType:'json'	
		}
	).then(
		res=>{
		console.log(res.data);
		//limpa();
		obtemProdutos();
		}
	).catch(error=>{
		console.error(error);
	});
}

function guardar(){
	let produto={ 
	produto: document.getElementById('produto').value,
	valor: document.getElementById('valor').value,
	data_compra: document.getElementById('data_compra').value,
	tipo: document.getElementById('tipo').value
	};
	console.log('Guardar Produto',produto) // verificar no html se no button está onClick
axios(
		{
		method:'POST',
		url: url,
		responseType:'json',
		data: produto	
		}
	).then(
		res=>{
		console.log(res.data);
		limpar();
		obtemProdutos();
		}
	).catch(error=>{
		console.error(error);
	});
}



function limpar(){
	 document.getElementById('produto').value=null;
	 document.getElementById('valor').value=null;
	 document.getElementById('data_compra').value=null;
	 document.getElementById('tipo').value=null;

	document.getElementById('btn-guardar').style.display='inline';
	document.getElementById('btn-atualizar').style.display='none';
}

function atualizar(){
let produto={ 
	produto: document.getElementById('produto').value,
	valor: document.getElementById('valor').value,
	data_compra: document.getElementById('data_compra').value,
	tipo: document.getElementById('tipo').value
	};
	console.log('Atualizar Produto'+produto) // verificar no html se no button está onClick
axios(
		{
		method:'PUT',
		url: url + `?id=${produtoSelecionado}`,
		responseType:'json',
		data: produto	
		}
	).then(
		res=>{
		console.log(res);
		limpar();
		obtemProdutos();
		}
	).catch(error=>{
		console.error(error);
	});
}

function selecionar(indice){
	produtoSelecionado= indice;
	console.log('Elemento selecionado: '+ indice);
axios(
		{
		method:'GET',
		url: url+`?id=${indice}`,
		responseType:'json'
		}
	).then(
		res=>{
		console.log(res);
 		document.getElementById('produto').value=res.data.produto;
		document.getElementById('valor').value=res.data.valor;
	 	document.getElementById('data_compra').value=res.data.data_compra;
	 	document.getElementById('tipo').value=res.data.tipo;
		document.getElementById('btn-guardar').style.display='none';
		document.getElementById('btn-atualizar').style.display='inline';
		}
	).catch(error=>{
		console.error(error);
	});
}

