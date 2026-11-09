import http from 'node:http';

const server = http.createServer((request, response) => {
	response.writeHead(200, { 'Content-Type': 'text/plain' });
	response.end(`Requested ${request.url}`);
});

server.listen(process.env.PORT || 3000);
