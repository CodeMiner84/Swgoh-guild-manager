import React from 'react';
import PropTypes from 'prop-types';

const Filtering = ({ handleFiltering }) => (
  <input className="form-control form-control-dark w-100" type="text" onChange={handleFiltering} placeholder="Search" aria-label="Search" />
);

Filtering.propTypes = {
  handleFiltering: PropTypes.func.isRequired,
};

export default Filtering;
