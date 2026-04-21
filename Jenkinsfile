pipeline {
    agent any

    stages {
        stage('Clone') {
            steps {
                git url: 'https://github.com/ImaneTech/app-gestion-reclamations.git', 
                    branch: 'main'
            }
        }

        stage('Tests') {
            steps {
                // 'if exist' is the Windows equivalent of 'test -f'
                bat 'if exist index.html (echo File exists) else (exit 1)'
                bat 'if exist style.css (echo File exists) else (exit 1)'
                bat 'if exist script.js (echo File exists) else (exit 1)'
            }
        }

        stage('Build Docker Image') {
            steps {
                bat 'docker build -t app-reclamations:latest .'
            }
        }

        stage('Deploy') {
            steps {
                // In Batch, '||' works slightly differently, so we use a cleaner check
                bat '''
                    docker stop app-reclamations >nul 2>&1
                    docker rm app-reclamations >nul 2>&1
                    docker run -d -p 80:80 --name app-reclamations app-reclamations:latest
                '''
            }
        }
    }

    post {
        success { echo 'Pipeline reussi!' }
        failure { echo 'Pipeline echoue!' }
    }
}