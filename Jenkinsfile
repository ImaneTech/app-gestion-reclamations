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
                sh 'test -f index.html'
                sh 'test -f style.css'
                sh 'test -f script.js'
            }
        }

        stage('Build Docker Image') {
            steps {
                sh 'docker build -t app-reclamations:latest .'
            }
        }

        stage('Deploy') {
            steps {
                sh '''
                    docker stop app-reclamations || true
                    docker rm app-reclamations || true
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