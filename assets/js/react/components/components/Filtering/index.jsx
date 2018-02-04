import React from 'react';

import Container from './Container';
import Inner from './Inner';
import FilterInput from './FilterInput';

const Filtering = (props) => (
  <Container>
    <Inner>
      <FilterInput placeholder="Type phrase to search ..." type="text" onChange={props.changePhrase} />
    </Inner>
  </Container>
);

export default Filtering;
