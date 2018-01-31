import React from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { createSelector } from 'reselect';
import actions from '../../actions/dashboard';
import ProductList from './ProductList';

class Dashboard extends React.Component {
  constructor(props) {
    super(props);
    this.props.getAll();
  }

  render() {
    return (
      <div >
        <ProductList products={this.props.products}/>
      </div>
    );
  }
}


Dashboard.propTypes = {
  getAll: PropTypes.func.isRequired,
};

const geDashboardProducts = state => state.dashboard.products;

const selector = createSelector(
  geDashboardProducts,
  (products) => {
    return products;
  },
);

function mapStateToProps(state) {
  return {
    products: selector(state),
  };
}
function mapStateToProps2(state) {
  return {
    products: state.dashboard.products,
  };
}

const mapDispatchToProps = {
  getAll: actions.fetchProducts,
};

export default connect(mapStateToProps, mapDispatchToProps)(Dashboard);
