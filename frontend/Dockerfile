FROM node:16.17.0-alpine

WORKDIR /home/node/app

COPY --chown=node:node package*.json ./
RUN npm install

COPY --chown=node:node . .
RUN chown -R node:node /home/node/app

RUN ls -l

USER node
CMD ["npm", "run", "dev"]
