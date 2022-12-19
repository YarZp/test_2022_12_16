import axios from "axios";
const baseUrl = "http://127.0.0.1:8000/api/task";

export const createTask = async (data) => {
  return axios
    .post(baseUrl, data)
    .then(function (response) {
      // console.log(response.data.results);
      return response.data;
    })
    .catch(function (error) {
      console.error(error);
    });
};

export const getAllTasks = async () => {
  return axios
    .get(baseUrl)
    .then(function (response) {
      // console.log(response.data.results);
      return response.data;
    })
    .catch(function (error) {
      console.error(error);
    });
};

export const editTask = async (id, data) => {
  return axios
    .patch(`${baseUrl}/${id}`, data)
    .then(function (response) {
      return response.data;
    })
    .catch(function (error) {
      console.error(error.response.data);
    });
};

export const deleteTask = async (id) => {
  return axios
    .delete(`${baseUrl}/${id}`)
    .then(function (response) {
      return response.data;
    })
    .catch(function (error) {
      console.error(error.response.data);
    });
};
