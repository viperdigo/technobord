
pipeline {
  environment {
    gitRepositoryUrl = "https://github.com/viperdigo/technobord.git"
    imagenameApp = "registry.rad.app.br/technobord"
    imagenameWeb = "registry.rad.app.br/technobord-nginx"
    registryUrl = "https://registry.rad.app.br"
    registryCredential = 'registry-credentials'
    dockerImageApp = ''
    dockerImageWeb = ''
  }
  agent any
  stages {
    stage('Cloning Git') {
      steps {
        git([url: gitRepositoryUrl, branch: 'master', credentialsId: '8e958a5e-77b7-4857-9437-54a83625827d'])
      }
    }
    stage('Building App Image') {
      steps{
        script {
          dockerImageApp = docker.build imagename
        }
      }
    }
    stage('Building Web Image') {
          steps{
            script {
              sh "docker build -f Dockerfile.nginx -t $imagenameWeb --build-arg ASSET_IMAGE=imagenameApp ."
            }
          }
        }
    stage('Push Images') {
      steps{
        script {
          docker.withRegistry( registryUrl, registryCredential ) {
            dockerImageApp.push("$BUILD_NUMBER")
            dockerImageWeb.push("$BUILD_NUMBER")
            dockerImageApp.push('latest')
            dockerImageWeb.push('latest')
          }
        }
      }
    }
    stage('Remove Unused Docker Image') {
      steps{
        sh "docker rmi $imagenameApp:$BUILD_NUMBER"
        sh "docker rmi $imagenameWeb:$BUILD_NUMBER"
         sh "docker rmi $imagenameApp:latest"
         sh "docker rmi $imagenameWeb:latest"
      }
    }
  }
}
