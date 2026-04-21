# projet_gestion_reclamation

## Containerisation (Docker)

### Lancer en local avec Docker Compose

Copiez d'abord le fichier d'environnement:

```bash
cp .env.example .env
```

```bash
docker compose up --build
```

Application: `http://localhost:8080`  
Base MySQL: `localhost:3306`

Le schéma est initialisé automatiquement depuis `assets/code/db.sql`.

### Variables d'environnement DB utilisées par l'application

- `DB_HOST` (défaut: `localhost`)
- `DB_NAME` (défaut: `gestion_reclamations`)
- `DB_USER` (défaut: `root`)
- `DB_PASS` (défaut: vide)

## CI/CD (GitHub Actions)

Workflow: `.github/workflows/ci-cd.yml`

### Étapes CI

1. Lint syntaxique PHP (`php -l`)
2. Build/push image Docker vers GHCR pour les `push`

### Étape CD (déploiement SSH)

Le job de déploiement s'exécute uniquement sur `main` si ces secrets existent:

- `DEPLOY_HOST`
- `DEPLOY_USER`
- `DEPLOY_SSH_KEY`
- `GHCR_PULL_USER`
- `GHCR_PULL_TOKEN` (token en lecture `read:packages`)

Secrets DB de production attendus:

- `PROD_DB_HOST`
- `PROD_DB_NAME`
- `PROD_DB_USER`
- `PROD_DB_PASS`
