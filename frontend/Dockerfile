FROM node:16.17.0-alpine

WORKDIR /app_frontend
COPY package.json .
RUN npm install

COPY . .

CMD [ "npm", "run", "dev" ]
