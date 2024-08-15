use hf;

INSERT INTO users (username, email, password) VALUES ("almafa","lszlmig@gmail.com","$2y$10$4PtTtrrHiGr2TK.aWHv8XuyVptWmrbtaJrxah0SR5jV73AAlHDL0G"),
("kisjeno","kisjeno@gmail.com","$2y$10$gigE8CnjnhBtiFkj1EhDo.xpDLCzDDpQxDxNkvy66iSGpt3X6475m"),
("janos","janos@gmail.com","$2y$10$DWeCxPJyoidCjXp.rwFqfOo2Y28NGXmIxvqJlYghplIa6JuQz.j6i"),
("almafak","almafak@gmail.com","$2y$10$tT8ifyeFmrVqKMDtRWBav.o4tXpXmie0oEejvo7kreevBcgtoi0Jq"),
("kalaposjani","kalaposjani@gmail.com","$2y$10$jQAs1pmLa9IU0iKs4sfqsuXzQPdzJC4qkpJqCT2RH4phJwH1pSZCy"),
("thelegend27","thelegend27@gmail.com","$2y$10$fEMhH.81tFUs6EFh7A37redjDsk7.ptDompGx.4QHNYSm7kyPV1ia");

INSERT INTO recipes (title, Users_id, creation_date) VALUES ("TÖKFŐZELÉK PIROSPAPRIKÁSAN", "22",NOW()),
("SPÁRGÁS-ZÖLDBORSÓS PITE", "22",NOW()),
("EGYSERPENYŐS RIZSES-ZÖLDSÉGES CSIRKE", "20",NOW()),
("GRILLEZETT ZÖLDSÉGEK", "21",NOW());
